export interface IUser {
    id: string,
    username: string,
    email: string,
    user_authenticated: boolean,
    hub: {
        id: string,
        name: string,
        creation_datetime: string
    },
    isLoading: boolean
}

// export class UserDTO implements IUser {
//     user: {
//         id: string = '',
//         username: string = '',
//         email: string = '',
//         user_authenticated: boolean,
//         hub: {
//             id: string = '',
//             name: string = '',
//             creation_datetime: string = ''
//         },
//         isLoading: boolean
//     }
// }
//
//
// export default class User extends UserDTO {
//     constructor(dto: UserDTO){
//         super();
//         Object.assign(this, dto);
//     }
// }
