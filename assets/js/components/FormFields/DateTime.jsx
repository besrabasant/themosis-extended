import {__experimentalGetSettings, format, isInTheFuture} from "@wordpress/date";
import {DatePicker, Dropdown} from "@wordpress/components";
import {withState} from "@wordpress/compose";
import {FieldWrapper} from "./FieldWrapper";

//TODO: Allow option to clear date.

const DATE_FORMAT = 'YYYY-MM-DD'

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
            date = moment(attributes.value, DATE_FORMAT).toDate()
        } else if (attributes.default) {
            date = moment(attributes.default, DATE_FORMAT).toDate()
        } else {
            date = new Date();
        }
    }

    function onChange(date) {
        setState({date})
    }

    let {readonly, class: className, ...fieldAttributes} = attributes.attributes;

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
                        <input className='form-control' onClick={onToggle} type="text"
                               name={`${attributes.name}__human`}
                               onChange={() => {
                               }}
                               value={(attributes.options.allow_null) ? "" : format('d/m/Y', date)}
                               readOnly={readonly}
                               {...fieldAttributes} />
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

