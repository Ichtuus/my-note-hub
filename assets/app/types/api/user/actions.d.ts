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

