import Axios, { AxiosResponse } from 'axios'
import { APIResponse } from '../../types/api'
import { APIHub } from '../../types/api/hub/actions'

function getHubsProcess (): Promise<APIResponse<APIHub>> {
    return Axios.get(Routing.generate('my_note_hub_api_hub_get'))
        .then((response: AxiosResponse) => response.data)
}

export default {
    getHubsProcess
}
