from index import conn
from datetime import datetime

cursor = conn.cursor()

# Display all new admissions
cursor.execute("SELECT * FROM new_admission")
students = cursor.fetchall()

print("===== New Admission Records =====\n")

for student in students:
    print(f"""
ID       : {student[0]}
Name     : {student[1]}
Age      : {student[2]}
Address  : {student[3]}
DOB      : {student[4]}
Gender   : {student[5]}
Class    : {student[6]}
-------------------------------------
""")

# Ask the user which admission record to use
admission_id = int(input("Enter ID to admit the student: "))

# Retrieve that student's details
cursor.execute(
    "SELECT name, age FROM new_admission WHERE id = %s",
    (admission_id,)
)

student = cursor.fetchone()

if student:

    name = student[0]
    age = student[1]

    print(f"\nStudent Selected: {name}")
    print(f"Age: {age}")

    roll_no = int(input("Enter Roll Number: "))
    class_no = int(input("Enter Class: "))
    stream = input("Enter Stream: ")

    # Generate a unique admission number
    admission_no = "ADM" + datetime.now().strftime("%Y%m%d%H%M%S")

    sql = """
    INSERT INTO students
    (name, roll_no, admission_no, class_no, stream, age)
    VALUES (%s, %s, %s, %s, %s, %s)
    """

    values = (
        name,
        roll_no,
        admission_no,
        class_no,
        stream,
        age
    )

    cursor.execute(sql, values)
    conn.commit()

    print("\nStudent added successfully!")
    print("Admission Number:", admission_no)

else:
    print("Admission ID not found.")

cursor.close()
conn.close()