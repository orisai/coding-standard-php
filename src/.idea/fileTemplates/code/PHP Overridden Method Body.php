#if (${RETURN} == "return")
$result = parent::${NAME}(${PARAM_LIST});

return $result;
#else
parent::${NAME}(${PARAM_LIST});
#end