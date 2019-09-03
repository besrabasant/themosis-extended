import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FieldWrapper} from "./FieldWrapper";
import {useState} from '@wordpress/element'

export const IntegerField = ({attributes}) => {

    let [value, setValue] = useState((attributes.value || attributes.attributes.value))

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <input type="number" className="form-control" name={attributes.name} id={attributes.attributes.id}
                   onChange={onChange}
                   min={attributes.attributes.min}
                   step={attributes.attributes.step}
                   value={value}
                   autoComplete="off"/>
        </FieldWrapper>
    )
}

registerComponent('themosis.fields.integer', {
    renderProp: IntegerField
})