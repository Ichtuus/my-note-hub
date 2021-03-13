import Axios, { AxiosResponse } from 'axios'
import { APIResponse } from '../../types/api'
import { APIHubs } from '../../types/api/hub/actions'

function getHubsProcess (): Promise<APIResponse<APIHubs>> {
    return Axios.get(Routing.generate('my_note_hub_api_get_hubs'))
        .then((response: AxiosResponse) => response.data)
}

function getHubProcess (hubId: string): Promise<APIResponse<APIHubs>> {
    return Axios.get(Routing.generate('my_note_hub_api_get_hub', { id: hubId }))
        .then((response: AxiosResponse) => response.data)
}

export default {
    getHubsProcess,
    getHubProcess
}
