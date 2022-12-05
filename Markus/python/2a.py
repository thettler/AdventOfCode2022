import fileinput

score=0
for line in fileinput.input():
    line = line.strip()

    myChoice = line[2]
    theirChoice = line[0]

    if(myChoice=="X"):
        score+=1
    if(myChoice=="Y"):
        score+=2
    if(myChoice=="Z"):
        score+=3
    
    if(line in ["A Y","B Z","C X"]):
        score+=6 #win
    if(line in ["A X","B Y","C Z"]):
        score+=3 #draw


print(score)

    # A,X = Rock
    # B,Y = Paper
    # C,Z = Scissors
