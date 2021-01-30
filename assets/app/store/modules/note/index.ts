import {Action, Module, Mutation, VuexModule} from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import NoteApi from '../../../api/note/note'

@Module({ namespaced: true, name: modules.note, stateFactory: true })
export default class NoteModule extends VuexModule {

    private _notes: any = []
    private _isEditingNote = false

    @Action
    async add ({ newNote, id }: { newNote: any, id: string }): Promise<void> {
        try {
            const {note} = await NoteApi.addNoteProcess(newNote, id)
            this.context.commit(m.ADD_NOTE_LIST, { note })
        } catch (e) {
            console.log('e', e.response)
        }
    }

    @Action
    async get (hubId: string): Promise<void> {
        try {
            const notes = await NoteApi.getNoteProcess(hubId)
            this.context.commit(m.LOAD_NOTES, { notes })
        } catch (e) {
            console.log('e', e.response)
        }
    }

    @Action
    async patch ({ noteId, payload }: { noteId: string, payload: any }): Promise<void> {
        this.context.commit(m.IS_EDITING_NOTE, { isLoading: true, mode: 'edit_note' })
        try {
            const { note } = await NoteApi.patchNoteProcess({ noteId, payload })
            this.context.commit(m.UPDATE_NOTE, { note })
            console.log('this.note', this._notes)
            this.context.commit(m.IS_EDITING_NOTE, { isLoading: false, mode: 'edit_note' })
        } catch (e) {
            console.log('e', e.response)
            this.context.commit(m.IS_EDITING_NOTE, { isLoading: false, mode: 'edit_note' })
        }
    }

    get notes () {
        return this._notes
    }

    get isEditingNote () {
        return this._isEditingNote
    }

    @Mutation
    [m.ADD_NOTE_LIST] ({ note }: { note: any }): void {
        this._notes.unshift(note)
    }

    @Mutation
    [m.UPDATE_NOTE] ({ note }: { note: any }): void {
        this._notes[this._notes.findIndex((x: { id: any }) => x.id == note.id)] = note
    }

    @Mutation
    [m.IS_EDITING_NOTE] ({ isLoading, mode }: { isLoading: boolean, mode: string }): void {
        if (mode === 'edit_note') {
            this._isEditingNote = isLoading
        }
    }

    @Mutation
    [m.LOAD_NOTES] ({ notes }: { notes: any } ): void {
        this._notes = notes
    }
}
