import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import {IUser} from '../../models/user'
import {UserApi} from '../../../api/user/user'

@Module({ namespaced: true, name: modules.user, stateFactory: true })
export default class UserModule extends VuexModule {
    private _user: any = {
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

    @Action
    async registration (payload: any): Promise<void> {
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
            this.context.commit( m.UPDATE_USER, data )
            this.context.commit( m.IS_LOADING_UPDATE, false )
        } catch (e) {
            this.context.commit( m.IS_LOADING_UPDATE, false )
            console.log('error store on information', e)
        }
    }

    @Mutation
    [m.IS_LOADING_UPDATE] (isLoading: boolean): void {
        this._user.isLoading = isLoading
    }

    @Mutation
    [m.UPDATE_USER] (data: IUser): void {
        this._user = data
    }

    get userHubId (): string {
        return this._user.hub.id
    }

    get userAuthenticated (): boolean {
        return this._user.user_authenticated
    }

    get isLoading (): boolean {
        return this._user.isLoading
    }
}
