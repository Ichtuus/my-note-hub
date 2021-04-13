import {Vue} from "vue-property-decorator";

export default class Randomizer extends Vue {
    getRandomValue(value: string[]): string {
       return value[Math.floor(Math.random() * value.length)]
    }
}
