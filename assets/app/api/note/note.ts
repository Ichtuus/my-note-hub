import Axios, {AxiosResponse} from 'axios'
import { APINote } from '../../types/api/note/actions'
import { APIResponse } from '../../types/api'

function addHubNoteProcess (newNote: any, id: string): Promise<APIResponse<APINote>> {
    return Axios.post(Routing.generate( 'my_note_hub_api_note_add', {id}), {
        note_title: newNote.note_title,
        note_content: newNote.note_content,
        note_first_link: newNote.note_first_link,
        note_second_link: newNote.note_second_link,
        note_third_link: newNote.note_third_link
    }).then((response: AxiosResponse) => response.data)
}

function getHubNoteProcess (hubId: string): Promise<APIResponse<APINote>> {
    return Axios.get(Routing.generate('my_note_hub_api_note_get', { id: hubId }))
        .then((response: AxiosResponse) => response.data)
}

function patchHubNoteProcess ({noteId, payload}: {noteId: string, payload: any}): Promise<APIResponse<APINote>>  {
    return Axios.patch(Routing.generate('my_note_hub_api_note_patch', { id: noteId }), payload)
        .then((response: AxiosResponse) => response.data)
}

function deleteHubNoteProcess ({noteId}: {noteId: string}): Promise<any> {
    return Axios.delete(Routing.generate('my_note_hub_api_note_delete', { id: noteId }))
        .then((response: AxiosResponse) => response.data)
}

export default {
    addHubNoteProcess,
    getHubNoteProcess,
    patchHubNoteProcess,
    deleteHubNoteProcess
}
