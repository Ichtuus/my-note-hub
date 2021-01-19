import axios, {AxiosResponse} from 'axios'
import {INoteAddRequestInterface} from '../interfaces/note/add'
import {INote} from '../../store/models/note'

function addNoteProcess (newNote: any, id: string): Promise<any> {
    return axios.post( Routing.generate( 'my_note_hub_api_note_add', {id}), {
        note_title: newNote.note_title,
        note_content: newNote.note_content,
        note_first_link: newNote.note_first_link,
        note_second_link: newNote.note_second_link,
        note_third_link: newNote.note_third_link
    }).then((response: AxiosResponse) => response.data)
}
function getNoteProcess (hubId: string) {
    return axios.get(Routing.generate('my_note_hub_api_note_get', { id: hubId }
    )).then((response: AxiosResponse) => response.data)
}

function patchNoteProcess (noteId: string) {
    return axios.patch(Routing.generate('my_note_hub_api_note_patch', { id: noteId }
    )).then((response: AxiosResponse) => response.data)
}

export default {
    addNoteProcess,
    getNoteProcess,
    patchNoteProcess
}
