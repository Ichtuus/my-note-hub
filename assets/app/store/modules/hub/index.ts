import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import HubApi from '../../../api/hub/hub'
import { APIHubs, APIHub } from '../../../types/api/hub/actions'

@Module({ namespaced: true, name: modules.hub, stateFactory: true })
export default class HubModule extends VuexModule {
    private _hubs: APIHubs[] = []
    private _hub: APIHub = <APIHub>{}
    private _isLoading = false

    @Action
    async getHubs (): Promise<void> {
        try {
            this.context.commit( m.IS_LOADING, true )
            const { data } = await HubApi.getHubsProcess()
            this.context.commit( m.LOAD_HUBS, { data } )
            this.context.commit( m.IS_LOADING, false )
        } catch (e) {
            console.log('e', e)
            this.context.commit( m.IS_LOADING, false )
        }
    }

    @Action
    async getHub (hubId: string): Promise<void> {
        try {
            this.context.commit( m.IS_LOADING, true )
            const data = await HubApi.getHubProcess(hubId)
            console.log('data', data)
            this.context.commit( m.LOAD_HUB_INFORMATION, data )
            this.context.commit( m.IS_LOADING, false )
        } catch (e) {
            console.log('e', e)
            this.context.commit( m.IS_LOADING, false )
        }
    }

    get hubs (): APIHubs[] {
        return this._hubs
    }

    get hub (): APIHub {
        return this._hub
    }

    get isLoading (): boolean {
        return this._isLoading
    }

    [m.IS_LOADING] (isLoading: boolean): void {
        this._isLoading = isLoading
    }

    @Mutation
    [m.LOAD_HUBS] ({ data }: any): void {
        this._hubs = data
    }

    @Mutation
    [m.LOAD_HUB_INFORMATION] ( data: any ): void {
        this._hub = data
    }
}
