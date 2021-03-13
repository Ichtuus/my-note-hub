import { APIDatetime } from '../global/actions'

export interface APIUser {
    id: string,
    email: string,
    username: string,
    hub: {
        id: string,
        name: string,
        creation_datetime: string
    },
    user_authenticated: boolean
}

export interface APIUserRole {
    id: string,
    role: string,
    creationDatetime: APIDatetime,
    user: APIUser,
    hub: string
}

export interface APIUserCreator {
    id: string,
    username: string,
    salt: boolean,
    password: string,
    email: string,
    roles: any,
    apiToken: null,
    hub: string,
    hubsUserRoles: APIHubsUserRoles,
    hubsUsers: APIHubsUsers,
    __initializer__: null,
    __cloner__: null,
    __isInitialized__: boolean
}

export interface APIHubsUserRoles {
    id: string,
    role: string,
    creationDatetime: APIDatetime,
    user: string,
    hub: string
}

// is an array of users
export interface APIHubsUsers {
    id: string,
    role: string,
    creationDatetime: APIDatetime,
    user: string,
    hub: string
}
