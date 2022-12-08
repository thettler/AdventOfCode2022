import fileinput
import re

count=0
for line in fileinput.input():
    line = line.strip()

    a1,a2,b1,b2=[int(x) for x in re.split(',|-',line)]

    if a1<=b1 and b2<=a2 or a1>=b1 and b2>=a2:
        count+=1

print(count)