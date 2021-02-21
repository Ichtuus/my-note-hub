import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import HubApi from '../../../api/hub/hub'
import { APIHub } from '../../../types/api/hub/actions'

@Module({ namespaced: true, name: modules.hub, stateFactory: true })
export default class HubModule extends VuexModule {
    private _hubs: APIHub[] = []
    private _isLoading = false

    @Action
    async getHubs (): Promise<void> {
        try {
            this.context.commit( m.IS_LOADING, true )
            const data = await HubApi.getHubsProcess()
            console.log('fdata', data)
            this.context.commit( m.LOAD_HUBS, data )
            this.context.commit( m.IS_LOADING, false )
        } catch (e) {
            console.log('e', e)
            this.context.commit( m.IS_LOADING, false )
        }
    }

    get hubs (): APIHub[] {
        return this._hubs
    }

    get isLoading (): boolean {
        return this._isLoading
    }

    [m.IS_LOADING] (isLoading: boolean): void {
        this._isLoading = isLoading
    }

    @Mutation
    [m.LOAD_HUBS] (data: APIHub[]): void {
        this._hubs = data
    }
}
