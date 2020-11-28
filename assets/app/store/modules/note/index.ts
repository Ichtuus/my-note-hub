import { Action, Module, Mutation, VuexModule } from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import {INote} from '../../models/notes'

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
    add({payload}): void {
        this.context.commit(m.UPDATE_NOTE_LIST, {payload})
    }

    @Mutation
    [m.UPDATE_NOTE_LIST] ({payload}): void {
        console.log('mutate', payload)
    }

    get notes() {
        return this._note
    }
}
