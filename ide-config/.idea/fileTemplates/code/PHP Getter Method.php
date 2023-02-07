#if(${RETURN_TYPE})
/**
 * @return #if(${TYPE_HINT} == 'array')array<mixed>#else${TYPE_HINT}#end
 */
#end
public ${STATIC} function ${GET_OR_IS}${NAME}()#if(${RETURN_TYPE}): ${RETURN_TYPE}#else#end
{
#if (${STATIC} == "static")
    return self::$${FIELD_NAME};
#else
    return $this->${FIELD_NAME};
#end
}