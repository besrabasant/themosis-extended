/**
 * @param {boolean} props.validation.errors
 * @param {string[]} props.validation.messages
 * @param {string} props.validation.placeholder
 * @param {string} props.validation.rules
 */
export default ({validation}) => {
    return (validation.messages.length) ?
        (<ul className="th-errors-list invalid-feedback">
            {validation.messages.map((message, key) => (<li key={key}>{message}</li>))}
        </ul>)
        :
        null
}