#!/bin/bash
for d in ./initial/good ./initial/bad ./initial/baddest ./initial/badder ./01-simpleClass ./featureFlags/good ./featureFlags/bad ./featureFlags/badder ./featureFlags/baddest ./featureFlags/moreBadderThanTheBaddest/ ; do
# for d in ./featureFlags/good ; do
    echo $(pwd)/$d;
    docker run --rm --volume $(pwd)/$d:/project herloct/phpmetrics --report-html=metrics .;
done

