const FIELD_DATA_REGEX = /(<!--|-->)/g

export const dataParser = (rawData) => JSON.parse(rawData.replace(FIELD_DATA_REGEX, ''))