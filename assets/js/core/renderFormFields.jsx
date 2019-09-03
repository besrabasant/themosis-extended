import {render} from "@wordpress/element"
import {dataParser} from "./utils";
import {createComponent} from "./component";

export function RenderFormFields() {
    let dateInputs = document.querySelectorAll('.form-group--date')

    if (!dateInputs.length) {
        return
    }

    dateInputs.forEach($el => {

        // let attributes = dataParser($el.innerHTML)
        // let DateTimeFieldComponent = createComponent('themosis.fields.datetime')
        //
        // render(<DateTimeFieldComponent attributes={attributes}/>, $el)
    })
}