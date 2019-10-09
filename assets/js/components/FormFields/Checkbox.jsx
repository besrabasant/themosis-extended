import {useState} from "@wordpress/element";
import {SyntheticEvent} from "react";
import {Label} from "./Label";
import FieldInfo from "../Form/FieldInfo";
import FieldErrors from "../Form/FieldErrors";
import {FormGroup} from "../Form";

function transformToBool(value) {
    return (String(value) === 'true' || String(value) === 'on')
}

export const CheckboxField = ({attributes}) => {

    let initialValue = transformToBool((attributes.value || attributes.default))
    let {class: classAttr, ...fieldAttributes} = attributes.attributes

    let [value, setValue] = useState(initialValue)

    /**
     * @param {SyntheticEvent} event
     */
    function onChange(event) {
        setValue(!value)
    }

    return (
        <FormGroup attributes={attributes}>
            <input type="checkbox" className="form-control" name={attributes.name}
                   onChange={onChange}
                   value={value}
                   checked={value}
                   autoComplete="off" 
                   {...fieldAttributes} />
            <Label labelAttributes={attributes.label}/>
            <FieldInfo info={attributes.options.info}/>
            <FieldErrors validation={attributes.validation}/>
        </FormGroup>
    )
}
