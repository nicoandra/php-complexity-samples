#!/bin/bash
for d in boolean-param duplicate-method nics nics-nogetter; do
    echo $(pwd)/$d;
    docker run --rm --volume $(pwd)/$d:/project herloct/phpmetrics --report-html=metrics .;
done

