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
            isLoading: true
        }
    }

    @Action
    async registration(payload: IUser): Promise<void> {
        try {
            console.log('uhe', payload)
            this.context.commit(m.IS_LOADING_UPDATE, true);
            await UserApi.registrationProcess(payload);
            console.log('response', UserApi)
            this.context.commit(m.IS_LOADING_UPDATE, false);
        } catch (e) {
            console.log('error store on registration', e)
        }
    }

}
