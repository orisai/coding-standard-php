#set($isReturnPhpdocUseful = !($TYPE_HINT.matches("^[a-zA-Z0-9]+")))
/**
${PARAM_DOC}
#if (${isReturnPhpdocUseful}) * @return ${TYPE_HINT}
#end
${THROWS_DOC}
*/