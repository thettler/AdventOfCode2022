use std::fs::File;
use std::io::{BufRead, BufReader};

pub fn day1() {
    let file = File::open("../Inputs/InputDay1.txt").expect("file not found");
    let reader = BufReader::new(file);

    let lines: Vec<String> = reader
        .lines()
        .map(|l| l.unwrap().parse().unwrap())
        .collect();

    let mut numbers = Vec::new();
    for line in lines {
        if line.is_empty() {
            numbers.push(0);
        } else {
            if numbers.is_empty() {
                numbers.push(0);
            }

            *numbers.last_mut().expect("not able to parse line") += line.parse::<i32>().unwrap();
        }
    }

    numbers.sort();

    println!("Top elf {}", numbers.last().unwrap());
    println!("Top 3 elfs {}", numbers.iter().rev().take(3).sum::<i32>());
}
