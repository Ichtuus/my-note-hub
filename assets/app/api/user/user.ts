import Axios from 'axios'
import {IAuthRequestInterface} from '../interfaces/user/authentification'
import {IInformationRequestInterface} from '../interfaces/user/information'

export abstract class UserApi {
    private static userAxios = Axios.create()

    static async registrationProcess (payload: any): Promise<any> {
        return await this.userAxios.post<IAuthRequestInterface>( Routing.generate( 'mnh_user_register' ), {
            username: payload.username,
            email: payload.email,
            password: payload.password
        })
    }

    static async userInformation (): Promise<any> {
        return await this.userAxios.get<IInformationRequestInterface>( Routing.generate( 'mnh_api_user_information' ))
    }
}
