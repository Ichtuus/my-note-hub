import {Action, Module, Mutation, VuexModule} from 'vuex-module-decorators'

import modules from '../modules'
import { mutations as m } from './constants'
import NoteApi from '../../../api/note/note'
import { APINote } from '../../../types/api/note/actions'

@Module({ namespaced: true, name: modules.note, stateFactory: true })
export default class NoteModule extends VuexModule {

    private _notes: APINote[] = []
    private _isLoading = false

    @Action
    async addNote ({ newNote, id }: { newNote: any, id: string }): Promise<void> {
        try {
            const { data } = await NoteApi.addNoteProcess(newNote, id)
            this.context.commit(m.ADD_NOTE_LIST, { data })
        } catch (e) {
            console.log('e', e.response)
        }
    }

    @Action
    async getNotes (hubId: string): Promise<void> {
        try {
            this.context.commit(m.IS_LOADING, { isLoading: true })
            const { data } = await NoteApi.getNoteProcess(hubId)
            this.context.commit(m.LOAD_NOTES, { data })
            this.context.commit(m.IS_LOADING, { isLoading: false })
        } catch (e) {
            console.log('e', e.response)
            this.context.commit(m.IS_LOADING, { isLoading: false })
        }
    }

    @Action
    async patchNote ({ noteId, payload }: { noteId: string, payload: any }): Promise<void> {
        this.context.commit(m.IS_LOADING, { isLoading: true })
        try {
            const { data } = await NoteApi.patchNoteProcess({ noteId, payload })
            this.context.commit(m.UPDATE_NOTE, { data })
            this.context.commit(m.IS_LOADING, { isLoading: false })
        } catch (e) {
            console.log('e', e.response)
            this.context.commit(m.IS_LOADING, { isLoading: false })
        }
    }
    @Action
    async deleteNote ({ noteId }: { noteId: string }): Promise<void> {
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

    get notes (): APINote[] {
        return this._notes
    }

    get isLoading (): boolean {
        return this._isLoading
    }

    @Mutation
    [m.ADD_NOTE_LIST] ({ data }: { data: APINote }): void {
        this._notes.unshift(data)
    }

    @Mutation
    [m.UPDATE_NOTE] ({ data }: { data: APINote }): void {
        this._notes[this._notes.findIndex((x: { id: string }) => x.id == data.id)] = data
    }

    @Mutation
    [m.REMOVE_NOTE] (noteId: string): void {
        this._notes = this._notes.filter((((item: { id: string }) => item.id !== noteId)))
    }

    @Mutation
    [m.IS_LOADING] ({ isLoading }: { isLoading: boolean }): void {
        this._isLoading = isLoading
    }

    @Mutation
    [m.LOAD_NOTES] ({ data }: { data: APINote[] } ): void {
        this._notes = data
    }
}
