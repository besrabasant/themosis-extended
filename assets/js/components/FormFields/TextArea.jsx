import {FieldWrapper} from "./FieldWrapper";
import {useState} from "@wordpress/element";
import {SyntheticEvent} from "react";

export const TextAreaField = ({attributes}) => {
    
    let [value, setValue] = useState((attributes.value || attributes.default))
    let {class: classAttr, ...fieldAttributes} = attributes.attributes

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(event.target.value)
        attributes.handlers.onChange && attributes.handlers.onChange(event.target.value, event)
    }

    return (
        <FieldWrapper attributes={attributes}>
            <textarea className="form-control" name={attributes.name}
                   onChange={onChange}
                   value={value}
                   autoComplete="off" {...fieldAttributes}/>
        </FieldWrapper>
    )
}