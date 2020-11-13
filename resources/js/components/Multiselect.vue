    <template>
    <div class="dropdown">
        <multiselect
                :selected.sync="selected"
                :show-labels="false"
                :options="options"
                :placeholder="placeholder"
                :searchable="false"
                :allow-empty="false"
                :multiple="false"
                key="name"
                label="name"
        ></multiselect>
        <label v-show="showLabel" for="multiselect"><span></span>Language</label>
    </div>
</template>

<script>
    import { Multiselect } from 'vue-multiselect';

    export default {
        components: { Multiselect },

        props: {
            options: {},
            placeholder: {
                default: 'Select one'
            },
            showLabel: {
                type: Boolean,
                default: true
            },
            selected: ''
        }
    };
</script>