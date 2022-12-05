import fileinput

count=0
for line in fileinput.input():
    line = line.strip()

    com1=line[:len(line)//2] #first half
    com2=line[len(line)//2:len(line)] #second half

    for item in com1:
        if item in com2:
            if item.islower():
                prio=ord(item)-96 #weird ascii positioning
            if item.isupper():
                prio=ord(item)-38 #weird ascii positioning
    count+=prio

print(count)