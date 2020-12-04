import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import {IUser} from '../../models/user'
import {UserApi} from '../../../api/user/user'

@Module({ namespaced: true, name: modules.user, stateFactory: true })
export default class UserModule extends VuexModule {
    private _user: IUser = {
        user: {
            id: '',
            username: '',
            email: '',
            user_authenticated: false,
            hub: {
                id: '',
                name: '',
                creation_datetime: ''
            },
            isLoading: false
        }
    }

    @Action
    async registration (payload: IUser): Promise<void> {
        try {
            this.context.commit( m.IS_LOADING_UPDATE, true )
            await UserApi.registrationProcess(payload);
            this.context.commit( m.IS_LOADING_UPDATE, false )
        } catch (e) {
            console.log('error store on registration', e)
        }
    }

    @Action
    async information (): Promise<void> {
        try {
            this.context.commit( m.IS_LOADING_UPDATE, true )
            const {data} = await UserApi.userInformation()
            this.context.commit( m.IS_LOADING_UPDATE, false )
            this.context.commit( m.UPDATE_USER, data )
        } catch (e) {
            this.context.commit( m.IS_LOADING_UPDATE, false )
            console.log('error store on information', e)
        }
    }

    @Mutation
    [m.IS_LOADING_UPDATE] (isLoading: boolean): void {
        this._user.user.isLoading = isLoading
    }

    @Mutation
    [m.UPDATE_USER] (isAuthenticated: boolean): void {
        this._user.user.user_authenticated = isAuthenticated
    }

    get userAuthenticated (): boolean {
        return this._user.user.user_authenticated
    }

    get isLoading (): boolean {
        return this._user.user.isLoading
    }
}
