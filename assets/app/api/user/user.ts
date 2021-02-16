import Axios, {AxiosResponse} from 'axios'
import {APIResponse} from "../../types/api";
import {APIUser} from "../../types/api/user/actions";


function registrationProcess (payload: any): Promise<APIResponse<APIUser>> {
    return Axios.post(Routing.generate( 'mnh_user_register' ), {
        username: payload.username,
        email: payload.email,
        password: payload.password
    }).then((response: AxiosResponse) => response.data)
}

function userInformation (): Promise<any> {
    return Axios.get(Routing.generate( 'mnh_api_user_information' ))
        .then((response: AxiosResponse) => response.data)
}


export default {
    registrationProcess,
    userInformation
}
