import Vue from "vue";
import Component from 'vue-class-component'
import MyModalsModule from '../../store/modules/myModals'
import {getModule} from 'vuex-module-decorators'

// Provide all needed event to modal nam
@Component
export class ModalManager extends Vue {
    open(name: string) {
        getModule(MyModalsModule, this.$store).updateIsActive({action: 'open', name})
    }

    close(name: string) {
        getModule(MyModalsModule, this.$store).updateIsActive({action: 'close', name})
    }
}
//
// export {orderArray};
//
// function orderArray (array) {
//     return array.sort(
//         (a, b) => (a.name > b.name)
//             ? 1
//             : ( (b.name > a.name) ? -1 : 0 )
//     )
// }
