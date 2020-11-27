import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import {IModal} from '../../models/modals'

@Module({ namespaced: true, name: modules.myModals, stateFactory: true })
export default class MyModalsModule extends VuexModule {

    public _myModal: IModal = {
        add: {
            active: false
        },
        triggeredModal: '',
        default: false
    }

    @Action
    updateIsActive({action, name}): void {
        this.context.commit(m.UPDATE_IS_ACTIVE, {action, name})
    }

    @Mutation
    [m.UPDATE_IS_ACTIVE] ({action, name}): void {
        if(name === 'default')  {
            this._myModal.default = false
        }
        if(action === 'open') {
            this._myModal.triggeredModal = name
            this._myModal[name].active = true
        }
        if(action === 'close') {
            this._myModal.triggeredModal = name
            this._myModal[name].active  = false
        }
    }

    get isActive() {
        return (nameOfModal: string) => {
            return this._myModal[nameOfModal].active
        }
    }

    get currentModal() {
        return this._myModal.triggeredModal
    }
}
