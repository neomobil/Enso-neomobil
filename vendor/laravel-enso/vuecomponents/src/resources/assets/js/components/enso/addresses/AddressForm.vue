<template>

    <transition enter-active-class="animated fadeIn"
        leave-active-class="animated fadeOut">
        <div class="modal is-active">
            <div class="modal-background"></div>
            <div class="modal-content">
                <a class="delete is-pulled-right has-margin-top-medium has-margin-right-medium"
                    @click="$emit('form-close')">
                </a>
                <vue-form class="box"
                    :data="form"
                    :params="params"
                    v-on="$listeners">
                    <template v-for="field in form.fields"
                        v-if="field.meta.custom"
                        :slot="field.column"
                        slot-scope="props">
                        <slot :name="props.field.column"
                            :field="props.field"
                            :errors="props.errors">
                        </slot>
                    </template>
                </vue-form>
            </div>
        </div>
    </transition>

</template>

<script>

import { mapGetters } from 'vuex';
import VueForm from '../vueforms/VueForm.vue';

export default {
    components: { VueForm },
    props: {
        form: {
            type: Object,
            default: null,
        },
        id: {
            type: Number,
            required: true,
        },
        type: {
            type: String,
            required: true,
        },
    },

    computed: {
        ...mapGetters('locale', ['__']),
        params() {
            return {
                id: this.id,
                type: this.type,
            };
        },
    },
};

</script>

<style scoped>

    .modal-content {
        width: 70%;
    }

</style>
