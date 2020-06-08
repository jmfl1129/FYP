# the below link to change to corresponding python exe in own computer
#!C:\Users\leekw\AppData\Local\Programs\Python\Python36\python.exe
import os
print("content-type: text/html\n\n" ) #keep this in all .py files to execute code.
 
 
print("Hello World")
print('<br/>')
 
URL = os.path.realpath('.')
print('sURL = ' + URL)
print('<br/>')
print(2*2+5)
 
 
#another example of a list.
 
list1= [1,2,'a',6,'b']
for item in list1:
    print('<br/>')
    print(item)
    