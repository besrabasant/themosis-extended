import {registerComponent} from "../../core/ThemosisExtendedAdmin";
import {FieldWrapper} from "./FieldWrapper";
import {useState} from "@wordpress/element";
import {SyntheticEvent} from "react";

export const TextField = ({attributes}) => {
    let [value, setValue] = useState((attributes.value || attributes.default))

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <input type="text" className="form-control" name={attributes.name} id={attributes.attributes.id}
                   onChange={onChange}
                   value={value}
                   autoComplete="off"/>
        </FieldWrapper>
    )
}

registerComponent('themosis.fields.text', {
    renderProp: TextField
})