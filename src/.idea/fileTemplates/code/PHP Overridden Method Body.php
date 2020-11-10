#if (${RETURN} == "return")
return parent::${NAME}(${PARAM_LIST});
#else
parent::${NAME}(${PARAM_LIST});
#end