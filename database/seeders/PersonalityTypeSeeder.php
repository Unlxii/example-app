<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonalityType;

class PersonalityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personalityTypes = [
            ['type' => 'ISTJ', 'name' => 'ISTJ', 'description' => 'The Inspector: Reserved and practical, they tend to be loyal, orderly, and traditional.'],
            ['type' => 'ISTP', 'name' => 'ISTP', 'description' => 'The Crafter: Highly independent, they enjoy new experiences that provide first-hand learning.'],
            ['type' => 'ISFJ', 'name' => 'ISFJ', 'description' => 'The Protector: Warm-hearted and dedicated, they are always ready to protect the people they care about.'],
            ['type' => 'ISFP', 'name' => 'ISFP', 'description' => 'The Artist: Easy-going and flexible, they tend to be reserved and artistic.'],
            ['type' => 'INFJ', 'name' => 'INFJ', 'description' => 'The Advocate: Creative and analytical, they are considered one of the rarest Myers-Briggs types.'],
            ['type' => 'INFP', 'name' => 'INFP', 'description' => 'The Mediator: Idealistic with high values, they strive to make the world a better place.'],
            ['type' => 'INTJ', 'name' => 'INTJ', 'description' => 'The Architect: Highly logical, they are both very creative and analytical.'],
            ['type' => 'INTP', 'name' => 'INTP', 'description' => 'The Thinker: Quiet and introverted, they are known for having a rich inner world.'],
            ['type' => 'ESTP', 'name' => 'ESTP', 'description' => 'The Persuader: Out-going and dramatic, they enjoy spending time with others and focusing on the here-and-now.'],
            ['type' => 'ESTJ', 'name' => 'ESTJ', 'description' => 'The Director: Assertive and rule-oriented, they have high principles and a tendency to take charge.'],
            ['type' => 'ESFP', 'name' => 'ESFP', 'description' => 'The Performer: Outgoing and spontaneous, they enjoy taking center stage.'],
            ['type' => 'ESFJ', 'name' => 'ESFJ', 'description' => 'The Caregiver: Soft-hearted and outgoing, they tend to believe the best about other people.'],
            ['type' => 'ENFP', 'name' => 'ENFP', 'description' => 'The Champion: Charismatic and energetic, they enjoy situations where they can put their creativity to work.'],
            ['type' => 'ENFJ', 'name' => 'ENFJ', 'description' => 'The Giver: Loyal and sensitive, they are known for being understanding and generous.'],
            ['type' => 'ENTP', 'name' => 'ENTP', 'description' => 'The Debater: Highly inventive, they love being surrounded by ideas and tend to start many projects (but may struggle to finish them).'],
            ['type' => 'ENTJ', 'name' => 'ENTJ', 'description' => 'The Commander: Outspoken and confident, they are great at making plans and organizing projects.']
        ];

        foreach ($personalityTypes as $type) {
            PersonalityType::create($type);
        }
    }
}