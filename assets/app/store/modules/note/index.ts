import {Action, Module, Mutation, VuexModule} from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import NoteApi from '../../../api/note/note'

@Module({ namespaced: true, name: modules.note, stateFactory: true })
export default class NoteModule extends VuexModule {

    private _notes: any = []
    private _isLoading = false

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
        this.context.commit(m.IS_LOADING, { isLoading: true })
        try {
            const { note } = await NoteApi.patchNoteProcess({ noteId, payload })
            this.context.commit(m.UPDATE_NOTE, { note })
            this.context.commit(m.IS_LOADING, { isLoading: false })
        } catch (e) {
            console.log('e', e.response)
            this.context.commit(m.IS_LOADING, { isLoading: false })
        }
    }
    @Action
    async delete ({ noteId }: { noteId: string }): Promise<void> {
        this.context.commit(m.IS_LOADING, { isLoading: true })
        try {
            await NoteApi.deleteNoteProcess({ noteId })
            this.context.commit(m.REMOVE_NOTE, noteId)
            this.context.commit(m.IS_LOADING, { isLoading: false })
        } catch (e) {
            console.log('e', e.response)
            this.context.commit(m.IS_LOADING, { isLoading: false })
        }
    }

    get notes () {
        return this._notes
    }

    get isLoading () {
        return this._isLoading
    }

    @Mutation
    [m.ADD_NOTE_LIST] ({ note }: { note: any }): void {
        this._notes.unshift(note)
    }

    @Mutation
    [m.UPDATE_NOTE] ({ note }: { note: any }): void {
        this._notes[this._notes.findIndex((x: { id: string }) => x.id == note.id)] = note
    }

    @Mutation
    [m.REMOVE_NOTE] (noteId :string): void {
        this._notes = this._notes.filter((((item: { id: string }) => item.id !== noteId)))
    }

    @Mutation
    [m.IS_LOADING] ({ isLoading }: { isLoading: boolean }): void {
        this._isLoading = isLoading
    }

    @Mutation
    [m.LOAD_NOTES] ({ notes }: { notes: any } ): void {
        this._notes = notes
    }
}
