echo 'copy to user'
mkdir -p /home/centos/workspace/magenta/trivex/api/user/api/utils
cp -R /home/centos/workspace/magenta/trivex/api/utils/src /home/centos/workspace/magenta/trivex/api/user/api/utils/
cp -R /home/centos/workspace/magenta/trivex/api/utils/config /home/centos/workspace/magenta/trivex/api/user/api/utils/


echo 'copy to event'
mkdir -p /home/centos/workspace/magenta/trivex/api/event/api/utils
cp -R /home/centos/workspace/magenta/trivex/api/utils/src /home/centos/workspace/magenta/trivex/api/event/api/utils/
cp -R /home/centos/workspace/magenta/trivex/api/utils/config /home/centos/workspace/magenta/trivex/api/event/api/utils/

echo 'copy to messaging'
mkdir -p /home/centos/workspace/magenta/trivex/api/messaging/api/utils
cp -R /home/centos/workspace/magenta/trivex/api/utils/src /home/centos/workspace/magenta/trivex/api/messaging/api/utils/
cp -R /home/centos/workspace/magenta/trivex/api/utils/config /home/centos/workspace/magenta/trivex/api/messaging/api/utils/

echo 'copy to person'
mkdir -p /home/centos/workspace/magenta/trivex/api/person/api/utils
cp -R /home/centos/workspace/magenta/trivex/api/utils/src /home/centos/workspace/magenta/trivex/api/person/api/utils/
cp -R /home/centos/workspace/magenta/trivex/api/utils/config /home/centos/workspace/magenta/trivex/api/person/api/utils/

echo 'copy to organisation'
mkdir -p /home/centos/workspace/magenta/trivex/api/organisation/api/utils
cp -R /home/centos/workspace/magenta/trivex/api/utils/src /home/centos/workspace/magenta/trivex/api/organisation/api/utils/
cp -R /home/centos/workspace/magenta/trivex/api/utils/config /home/centos/workspace/magenta/trivex/api/organisation/api/utils/

echo 'done'

