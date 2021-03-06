import {APIUserCreator, APIUserRole} from '../user/actions'

export interface APIHubs {
    id: string,
    name: string,
    creation_datetime: string,
    creator: string
}

export interface APIHub {
    id: string,
    creationDatetime: string,
    name: string,
    hubsUserRoles: APIUserRole,
    creator: APIUserCreator

}
