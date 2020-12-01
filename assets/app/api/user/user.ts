import Axios from 'axios'
import IUser from '../../store/models/user'

interface RequestInterface {
    id: string,
    email: string,
    username: string,
    hub: object,
    user_authenticated: boolean
}

export abstract class UserApi {
    private static userAxios = Axios.create()

    static async registrationProcess(payload: IUser): Promise<IUser>{
        let response = await this.userAxios.post<RequestInterface>(Routing.generate('mnh_user_register'), {
            username: payload.username,
            email: payload.email,
            password: payload.password
        })
        console.log('res api', response.data)

    }


}
