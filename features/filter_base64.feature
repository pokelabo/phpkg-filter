Feature: TrimFilter

  Scenario Outline: Base64EncodeFilter
    When "base64_encode"フィルタに"<option_map>"を設定して値"<value>"をフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value | option_map | result | comment |
    | 'abc' |            | YWJj   |         |
    | ''    |            |        |         |

  Scenario Outline: Base64DecodeFilter
    When "base64_decode"フィルタに"<option_map>"を設定して値"<value>"をフィルタする
    Then フィルタの結果は"<result>"である

    Examples:
    | value  | option_map | result | comment |
    | 'YWJj' |            | abc    |         |
    | ''     |            |        |         |
