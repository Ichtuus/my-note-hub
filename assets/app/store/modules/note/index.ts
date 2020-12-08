import {Action, getModule, Module, Mutation, VuexModule} from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import {INote} from '../../models/note'

import {NoteApi} from '../../../api/note/note'

@Module({ namespaced: true, name: modules.note, stateFactory: true })
export default class NoteModule extends VuexModule {

    public _note: INote = {
        note_title: '',
        note_content: '',
        note_first_link: '',
        note_second_link: '',
        note_third_link: ''
    }

    @Action
    async add ({newNote, id}): Promise<void> {
        console.log('newNote note', newNote, 'hib id', id)
        const data = await NoteApi.addNoteProcess(newNote, id)
        console.log('data', {data}, data)
        this.context.commit(m.UPDATE_NOTE_LIST, data)
    }


    @Mutation
    [m.UPDATE_NOTE_LIST] (data: INote): void {
        // console.log('mutate note', data)
        this._note = data
    }

    get notes () {
        return this._note
    }
}
