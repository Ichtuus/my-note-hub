import Axios from 'axios'
import {INoteAddRequestInterface} from '../interfaces/note/add'
import {INote} from '../../store/models/note'

export abstract class NoteApi {
    private static userAxios = Axios.create()

    static async addNoteProcess (user: INote, id: string): Promise<INote> {
        console.log('last point', id, 'et', user)
        return await this.userAxios.post<INoteAddRequestInterface>( Routing.generate( 'my_note_hub_api_note_add', {id}), {
            note_title: user.note_title,
            note_content: user.note_content,
            note_first_link: user.note_first_link,
            note_second_link: user.note_second_link,
            note_third_link: user.note_third_link
        })
    }
}
