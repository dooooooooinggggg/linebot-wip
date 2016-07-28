# file name: linebot.py
# coding:utf-8
 
import sys
import timetable
from datetime import datetime
import numpy as np
import operator

if __name__=='__main__':


    #receivetext = sys.argv[1]
    receivetext = '行き'
    #ここに処理を書く

    if receivetext == '行き':
    	nowhour   = datetime.now().strftime('%H')
    	nowminute = datetime.now().strftime('%M')
    	nowtime   = nowhour + nowminute

    	nowtime = int(nowtime)

    	gotimetable = timetable.gotimetable
    	#gotimetablekeys = gotimetable.keys().sort()
    	#timelist = 


    	index = np.searchsorted(gotimetablekeys,nowtime)

    	#タイムテーブルを参照
    	#リストから時間のみ(keys)を読み出す
    	#現在の時間のindexを出す
    	#そのindexのオブジェクトとその次を返す
    	#
    	#
    	#
    	#

    	print timetable.gotimetable
    	print gotimetable
    	print index
    	print gotimetable.keys().sort()

    #ここまで

    sendtext = nowtime#とりあえず

    print sendtext#ここでphpに戻している。