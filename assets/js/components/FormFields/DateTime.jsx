import {registerComponent} from '../../core/ThemosisExtendedAdmin'
import {__experimentalGetSettings, format, isInTheFuture} from "@wordpress/date";
import {DatePicker, Dropdown} from "@wordpress/components";
import {withState} from "@wordpress/compose";
import {FieldWrapper} from "./FieldWrapper";

//TODO: Allow option to clear date.

/**
 *
 * @param {Date} props.date
 * @param {Function} props.setState
 * @param {*} props.fieldAttributes
 * @returns {*}
 * @constructor
 */
const DateTimeInputDropdown = ({date, setState, attributes}) => {

    // console.log(attributes)

    const settings = __experimentalGetSettings()

    if (date || attributes.value || attributes.default) {
        attributes.options.allow_null = false
    }

    if (!date) {
        if (attributes.value) {
            date = moment(attributes.value).toDate()
        } else if (attributes.default) {
            date = moment(attributes.default).toDate()
        } else {
            date = new Date();
        }
    }

    function onChange(date) {
        setState({date})
    }

    return (
        <FieldWrapper attributes={attributes}>
            <Dropdown
                className="field-type--date"
                contentClassName="field-type--date-picker"
                position="bottom center"
                expandOnMobile={true}
                renderToggle={({onToggle}) => (
                    <>
                        <input type="hidden" name={attributes.name}
                               value={(attributes.options.allow_null) ? "" : format('Y-m-d', date)}/>
                        <input id={attributes.attributes.id} className='form-control' onClick={onToggle} type="text"
                               name={`${attributes.name}__human`} readOnly={attributes.attributes.readonly}
                               onChange={() => {
                               }}
                               value={(attributes.options.allow_null) ? "" : format('d/m/Y', date)}/>
                    </>
                )}
                renderContent={() => (
                    <DatePicker
                        isInvalidDate={(date) => (!isInTheFuture(date))}
                        currentDate={date}
                        onChange={onChange}
                        locale={settings.l10n.locale}
                    />
                )}
            />
        </FieldWrapper>
    )
}

export const DateTimeInput = withState({
    date: null,
})(DateTimeInputDropdown);

registerComponent('themosis.fields.datetime', {
    renderProp: DateTimeInput
})