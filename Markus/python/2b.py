import fileinput

score=0
for line in fileinput.input():
    line = line.strip()

    indicator = line[2]
    theirChoice = line[0]
    myChoice=""

    match indicator:
        case "X": #lose
            if(theirChoice=="A"):
                myChoice="Z"
            if(theirChoice=="B"):
                myChoice="X"
            if(theirChoice=="C"):
                myChoice="Y"
        case "Y": #draw
            if(theirChoice=="A"):
                myChoice="X"
            if(theirChoice=="B"):
                myChoice="Y"
            if(theirChoice=="C"):
                myChoice="Z"
            score+=3
        case "Z": #win
            if(theirChoice=="A"):
                myChoice="Y"
            if(theirChoice=="B"):
                myChoice="Z"
            if(theirChoice=="C"):
                myChoice="X"
            score+=6

    if(myChoice=="X"):
        score+=1
    if(myChoice=="Y"):
        score+=2
    if(myChoice=="Z"):
        score+=3

print(score)