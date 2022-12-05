import fileinput
bags=[]
for line in fileinput.input():
    bags.append(line.strip())

count=0
i=0
for i in range(i,len(bags)-2,3):
    bag1=bags[i]
    bag2=bags[i+1]
    bag3=bags[i+2]
    
    for item in bag1:
        if item in bag2:
            if item in bag3:
                if item.islower():
                    prio=ord(item)-96 #weird ascii positioning
                if item.isupper():
                    prio=ord(item)-38 #weird ascii positioning
    count+=prio

print(count)