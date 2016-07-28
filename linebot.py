# file name: linebot.py
# coding:utf-8
 
import sys
import timetable.py
from datetime import datetime
 
if __name__=='__main__':


    receivetext = sys.argv[1]

    #ここに処理を書く

    if receivetext == '行き':
    	nowhour   = datetime.now().strftime('%H')
    	nowminute = datetime.now().strftime('%M')
    	nowtime   = nowhour + nowminute
    	

    #ここまで

    sendtext = nowtime#とりあえず

    print sendtext#ここでphpに戻している。