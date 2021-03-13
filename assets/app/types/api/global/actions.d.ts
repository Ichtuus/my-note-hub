export interface APIDatetime {
    timezone: {
        name: string,
        transitions: [
            {
                ts: number,
                time: string,
                offset: number,
                isdst: boolean,
                abbr: string
            }
        ],
        location: {
            country_code: string,
            latitude: number,
            longitude: number,
            comments: string
        }
    },
    offset: number,
    timestamp: number
}
