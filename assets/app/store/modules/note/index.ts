import {Action, Module, Mutation, VuexModule} from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import NoteApi from '../../../api/note/note'

@Module({ namespaced: true, name: modules.note, stateFactory: true })
export default class NoteModule extends VuexModule {

    public _note: any = []

    @Action
    async add ({newNote, id}: {newNote: any, id: string}): Promise<void> {
        try {
            const {note} = await NoteApi.addNoteProcess(newNote, id)
            this.context.commit(m.UPDATE_NOTE_LIST, {note})
        } catch (e) {
            console.log('e', e.response)
        }
    }

    @Action
    async get (hubId: string): Promise<void> {
        try {
            const notes = await NoteApi.getNoteProcess(hubId)
            this.context.commit(m.LOAD_NOTES, {notes})
        } catch (e) {
            console.log('e', e.response)
        }
    }

    @Action
    async patch (noteId: string) {
        try {
            await NoteApi.patchNoteProcess(noteId)
        } catch (e) {
            console.log('e', e)
        }
    }


    get notes () {
        return this._note
    }

    @Mutation
    [m.UPDATE_NOTE_LIST] ({note}: { note: any }): void {
        this._note.unshift(note)
    }

    @Mutation
    [m.LOAD_NOTES] ({notes}: {notes: any} ): void {
        this._note = notes
    }
}
