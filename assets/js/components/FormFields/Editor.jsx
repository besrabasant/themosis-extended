/**
 * WordPress dependencies
 */
import {Component} from '@wordpress/element';
import {__, _x} from '@wordpress/i18n';
import {BACKSPACE, DELETE, F10} from '@wordpress/keycodes';
import {FieldWrapper} from "./FieldWrapper";
import {merge} from 'lodash'

const {wp, themosis_extended} = window;

export class RichTextEditor extends Component {
    constructor(props) {
        super(props)

        let {attributes} = props

        this.state = {
            value: (attributes.value || attributes.default)
        };

        this.initialize = this.initialize.bind(this)
        this.onSetup = this.onSetup.bind(this)
    }

    initialize() {
        let {attributes} = this.props

        tinyMCE.PluginManager.load('table', themosis_extended.tiny_mce_table_plugin)

        let settings = merge({},
            wp.editor.getDefaultSettings(),
            attributes.options.settings_js,
            {
                mediaButtons: true,
                quicktags: true,
                'tinymce': {
                    plugins: "charmap,colorpicker,hr,lists,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpautoresize,wpeditimage,wpemoji,wpgallery,wplink,wpdialogs,wptextpattern,wpview, table",
                    toolbar1: [
                        "wp_add_media",
                        "formatselect, bold, italic, underline, strikethrough",
                        "bullist, numlist, blockquote, alignleft, aligncenter, alignright, link, unlink table",
                        "hr, forecolor, pastetext, removeformat, charmap, outdent, indent, undo, redo, wp_help",
                    ].join(', '),
                    setup: this.onSetup,
                    'init_instance_callback': (editor) => {
                        editor.on('blur', () => {
                            this.setState({value: tinyMCE.get(attributes.attributes.id).getContent()});
                        });
                    }
                }
            }
        )

        wp.oldEditor.initialize(attributes.attributes.id, settings);
    }

    onSetup(editor) {

    }

    componentDidMount() {

        if (document.readyState === 'complete') {
            this.initialize();
        } else {
            window.addEventListener('DOMContentLoaded', this.initialize);
        }
    }

    componentDidUpdate(prevProps, prevState) {
        const {attributes} = this.props;
        const {value} = this.state;

        const editor = window.tinymce.get(attributes.attributes.id);

        if (prevState.value !== value) {
            editor.setContent(value || '');
        }
    }

    onChange(value) {
        this.setState({value})
    }

    render() {
        let {attributes} = this.props
        let {value} = this.state

        return (
            <FieldWrapper attributes={attributes}>
                <textarea className={'wp-editor'} name={attributes.name} id={attributes.attributes.id}
                          defaultValue={value}/>
            </FieldWrapper>)
    }
}
